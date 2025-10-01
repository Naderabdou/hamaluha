<?php

namespace App\Http\Controllers\Site\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\UpdateProfileRequest;
use App\Repositories\Provider\ProfileRepository;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected ProfileRepository $profileRepo;

    public function __construct(ProfileRepository $profileRepo)
    {
        $this->middleware('auth');
        $this->profileRepo = $profileRepo;
    }

    /**
     * عرض البروفايل
     */
    public function index()
    {
        $user = Auth::user();
        $store = $this->profileRepo->getByProviderId($user->id);

        return view('provider.profile.index', compact('user', 'store'));
    }

    /**
     * فورم التعديل
     */
    public function edit()
    {
        $user = Auth::user();
        $store = $this->profileRepo->getByProviderId($user->id);

        return view('provider.profile.edit', compact('user', 'store'));
    }

    /**
     * تحديث البيانات
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        // تحديث صورة (ممكن تكون null)
        $newImage = $this->profileRepo->handleImage($request, $user->id);

        // تحديث بيانات المستخدم
        $this->profileRepo->updateUser($user, $data);

        // تحضير بيانات المتجر
        $storeAttributes = $this->profileRepo->prepareStoreAttributes($data, $user);

        // ✅ لو في صورة جديدة بس حطها
        if ($newImage) {
            $storeAttributes['image'] = $newImage;
        } else {
            unset($storeAttributes['image']); // متحطش null
        }

        // تحديث بيانات المتجر
        $this->profileRepo->updateByProvider($user->id, $storeAttributes);

        return redirect()
            ->route('site.provider.profile.index')
            ->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
}
