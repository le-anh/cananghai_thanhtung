<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use Auth;
use Hash;
use App\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function changepasswordshow()
    {
        return view('auth.passwords.change_password');
    }

    public function changepasswordupdate(ChangePasswordRequest $request)
    {
        try {
            // 1. Kiểm tra mật khẩu cũ.
            if(self::CheckOldPassword($request->password))
                // 2. Kiểm tra mật khẩu mới & xác nhận mật khẩu mới.
                if(self::CheckNewPasswordAndConfirmNewPassword($request->password_new, $request->password_new_confirm))
                    // 3. Cập nhật mật khẩu mới.
                    if(self::ChangePassword(Auth::user()->id, $request->password_new))
                    {
                        Auth::logout();
                        return redirect()->route('login')->with('success', "Đã đổi mật khẩu thành công");
                    }
                    else
                        return redirect()->route('changepassword_show')->with('danger', "Lưu không thành công<br>Vui lòng thử lại");
                else
                    return redirect()->back()->withInput()->with('warning', "Mật khẩu mới và xác nhận mật khẩu mới không khớp");

            else
                return redirect()->back()->withInput()->with('warning', "Mật khẩu cũ không đúng");
        } catch (\Throwable $th) {
            return redirect()->route('changepassword_show')->with('danger', "Lưu không thành công<br>" . $th->getMessage());
        }
    }

    public function CheckOldPassword($oldPassword = '')
    {
        if(Hash::check($oldPassword, Auth::user()->password))
            return true;
        return false;
    }

    public function CheckNewPasswordAndConfirmNewPassword($newPassword, $confirmNewPassword)
    {
        if(strcmp($newPassword, $confirmNewPassword) == 0)
            return true;
        return false;
    }

    public function ChangePassword($userId, $passwordNew)
    {
        try {
            $user = User::find($userId);
            if($user)
            {
                $user->password = Bcrypt($passwordNew);
                $user->save();
                return true;
            }
            else
                return false;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
}
