<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Thông tin cá nhân
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Cập nhật tên hiển thị và địa chỉ email tài khoản.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="avatar-upload-field">
            <div class="avatar-preview-frame">
                @if ($user->avatar)
                    <img id="avatarPreview" src="{{ asset('storage/' . $user->avatar) }}" alt="Ảnh đại diện của {{ $user->name }}">
                    <span id="avatarPreviewFallback" hidden>{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</span>
                @else
                    <img id="avatarPreview" src="" alt="Xem trước ảnh đại diện" hidden>
                    <span id="avatarPreviewFallback">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</span>
                @endif
            </div>

            <div class="avatar-upload-copy">
                <x-input-label for="avatar" value="Ảnh đại diện" />
                <p>Chọn ảnh JPG, PNG hoặc WebP. Dung lượng tối đa 2MB.</p>
                <label for="avatar" class="avatar-select-btn">Chọn ảnh mới</label>
                <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="avatar-file-input">
                <span id="avatarFileName" class="avatar-file-name">Chưa chọn ảnh mới</span>
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>
        </div>

        <div>
            <x-input-label for="name" value="Tên hiển thị" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Địa chỉ email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        Email của bạn chưa được xác minh.

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Gửi lại email xác minh.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            Liên kết xác minh mới đã được gửi đến email của bạn.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Lưu thay đổi</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >Đã lưu thành công.</p>
            @endif
        </div>
    </form>
</section>

<script>
    // Xem trước ảnh đại diện ngay trên trình duyệt trước khi người dùng lưu form.
    document.getElementById("avatar")?.addEventListener("change", function (event) {
        const file = event.target.files?.[0];
        const preview = document.getElementById("avatarPreview");
        const fallback = document.getElementById("avatarPreviewFallback");
        const fileName = document.getElementById("avatarFileName");

        if (!file) return;

        preview.src = URL.createObjectURL(file);
        preview.hidden = false;
        fallback.hidden = true;
        fileName.textContent = file.name;
    });
</script>
