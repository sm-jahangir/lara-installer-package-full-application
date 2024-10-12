@extends('installer::install.app')

@section('head')
    <title>Maildoll - Organization Setup</title>
@endsection

@section('content')
    <div class="container mx-auto px-6">
        <!-- BEGIN: Page Layout -->
        <div class="page flex flex-col lg:flex-row h-screen lg:text-left">
            <div class="w-full lg:w-8/12 mx-auto">
                <!-- BEGIN: Admin Information -->
                <div class="bg-white shadow-lg rounded-lg p-6 mt-10 lg:mt-0">
                    <div class="border-b pb-4 mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">@translate(Create Admin User)</h2>
                    </div>
                    <form action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <!-- Admin Name -->
                        <div class="grid grid-cols-1 gap-6 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-semibold mb-2">
                                    @translate(Admin Name) <small class="text-red-500">@translate(required)</small>
                                </label>
                                <input type="text" name="name" class="input w-full border-gray-300 rounded-md p-3 mt-1 focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="@translate(Admin Name)" value="" required>
                            </div>

                            <!-- Admin Email -->
                            <div>
                                <label class="block text-gray-700 text-sm font-semibold mb-2">
                                    @translate(Admin Email) <small class="text-red-500">@translate(required)</small>
                                    <span class="text-gray-500 ml-1">Ex: admin@maildoll.com</span>
                                </label>
                                <input type="email" name="email" class="input w-full border-gray-300 rounded-md p-3 mt-1 focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Admin Email" value="" required>
                            </div>

                            <!-- Admin Password -->
                            <div>
                                <label class="block text-gray-700 text-sm font-semibold mb-2">
                                    @translate(Admin Password) <small class="text-red-500">@translate(required)</small>
                                </label>
                                <input type="password" name="password" class="input w-full border-gray-300 rounded-md p-3 mt-1 focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Admin Password" required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-6">
                            <button type="submit" class="w-full lg:w-auto px-5 py-3 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition focus:outline-none focus:ring focus:ring-blue-200">
                                @translate(Save and Next Step)
                            </button>
                        </div>
                    </form>
                </div>
                <!-- END: Admin Information -->
            </div>
        </div>
        <!-- END: Page Layout -->
    </div>
@endsection
