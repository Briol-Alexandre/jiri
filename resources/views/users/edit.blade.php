<x-layouts.auth>
    <section class="max-w-6xl mx-auto p-10">
        <h2 class="text-3xl font-extrabold text-blue-600 mb-10 text-center">
            Vos informations
        </h2>

        <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-10">
            @csrf
            @method('PATCH')

            <section class="bg-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">
                    Modifier vos informations
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label for="name" class="font-semibold text-gray-700">
                            Nom <small class="text-red-500">(requis)</small>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') ?? $user->name }}"
                               class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                               placeholder="John Doe">
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="email" class="font-semibold text-gray-700">
                            Email <small class="text-red-500">(requis)</small>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') ?? $user->email }}"
                               class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                               placeholder="john.doe@domain.com">
                        @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="font-semibold text-gray-700">
                            Mot de passe <small class="text-red-500">(laissez vide pour ne pas le changer)</small>
                        </label>
                        <input type="password" id="password" name="password" value="{{ old('password') }}"
                               class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                               placeholder="••••••••••">
                        @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>
            <div class="flex justify-center">
                <button type="submit"
                        class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg border border-blue-500 hover:bg-white hover:text-blue-500 transition">
                    Modifier vos informations
                </button>
            </div>
        </form>
    </section>
</x-layouts.auth>
