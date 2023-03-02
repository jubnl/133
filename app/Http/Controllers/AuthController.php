<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueTokenRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Requests\ReadCurrentUserRequest;
use App\Http\Requests\RevokeTokenRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class AuthController extends Controller
{
    /**
     * Login The User
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {

        $validateUser = $request->validated();

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        $user = User::where('email', $validateUser['email'])->first();

        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], status: 200);
    }

    /**
     * @param LogoutRequest $request
     * @return JsonResponse
     */
    public function logout(LogoutRequest $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(["message" => "logged out successfully"]);
    }

    /**
     * @param ReadCurrentUserRequest $request
     * @return JsonResponse
     */
    public function user(ReadCurrentUserRequest $request)
    {
        return response()->json($request->user());
    }

    /**
     * @param IssueTokenRequest $request
     * @return JsonResponse
     */
    public function issueToken(IssueTokenRequest $request)
    {
        $validated = $request->validated();
        $token = $request->user()->createToken($validated['token_name'], $validated['permissions'])->plainTextToken;
        return response()->json(data: [
            'message' => 'successful',
            'permissions' => $validated['permissions'],
            'token' => $token
        ], status: 201);
    }

    /**
     * @param RevokeTokenRequest $request
     * @param string $tokenId
     * @return JsonResponse
     */
    public function revokeTokenById(RevokeTokenRequest $request, string $tokenId)
    {
        $request->user()->tokens()->where('id', $tokenId)->delete();
        return response()->json(['message' => 'token ' . $tokenId . ' was revoked successfully.']);
    }


    /**
     * @param RevokeTokenRequest $request
     * @return JsonResponse
     */
    public function revokeAllTokens(RevokeTokenRequest $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Your tokens have been revoked.']);
    }
}
