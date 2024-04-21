<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.users')
        ->with(
            [
                'users' => User::getUsers(),
                'user' => Auth::user()
            ]
        );
    }

    public function createUser(Request $request)
    {
        
        $postData = request()->all();
        $validators = Validator::make($request->input(), [
            'surname' => 'required|string|max:40',
            'othernames' => 'sometimes|string|max:150',
            'tagNumber' => 'required|string', 
            'group' => 'in:A,B,C',
            'unit' => 'required|string',
            'image' => 'sometimes|string',
            'email' => 'sometimes|string',
            'phone' => 'sometimes|bail|numeric|digits_between:11,12',
            'address' => 'sometimes|string',
            'role' => 'sometimes|in:admin,user'
        ]);
        if ($validators->fails()) {
            return redirect()->back()->withErrors($validators)->withInput();
        }

        $saveUser = new User;
        $saveUser->surname = $postData['surname'];
        $saveUser->othernames = $postData['othernames'];
        $saveUser->tagNumber = $postData['tagNumber'];
        $saveUser->group = $postData['group'] ?? 'A';
        $saveUser->unit = $postData['unit'];
        $saveUser->image = $postData['image'] ?? '';
        $saveUser->email = $postData['email'];
        $saveUser->phone = $postData['phone'];
        $saveUser->address = $postData['address'] ?? '';
        $saveUser->password = Hash::make($postData['surname']);
        $saveUser->role = $postData['role'] ?? 'user';
        $saveUser->save();

        $saveQrCode = $this->generateUserQrCode($saveUser->id);

        // flash()->success('Success','User created successfully!');
        return redirect()->route('admin.users')->with([
            'user' => Auth::user(),
            'success' => 'User created successfully'
        ]);
    }

    public function addUser()
    {
        return view('admin.users.add_users')
        ->with([
                'user' => Auth::user()
        ]);
    }

    public function generateUserQrCode($userId)
    {
        $user = User::find($userId);
        if($user) {
            $directoryPath = public_path('qr_codes/');

            if (!File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0755, true, true);
            }
            $qrCodePath = 'qr_codes/user_' . $userId . '.png';
            QrCode::size(500)->format('png')->generate('https://google.com', public_path($qrCodePath));
            $user->qr_code = $qrCodePath;
            $user->save();
        }

        
        // $qrCode = QrCode::size(500)
        //         ->format('png')
        //         ->generate('https://google.com', public_path('qr_codes/'. $userId .'.png'));
        // $user = User::getUserById(userId);
        // if($user) {
        //     $image->move('images/events/', $filename);
        //     $user->qr_code = $userId.'.png';
        //     $user->save();
        // }
        
    }

    public function viewUser($userId)
    {
        $user = User::find($userId);
        return view('admin.users.view_user')
        ->with([
            'user' => $user,
        ]);
    }



}
