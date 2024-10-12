@extends('install.app')

@section('head')
    <title>Maildoll - Organization Setup</title>
@endsection

@section('content')

<div class="container mx-auto p-6">
    <!-- BEGIN: Error Page -->
    <div class="page flex flex-col lg:flex-row h-auto lg:h-screen lg:text-left">
        <div class="w-full lg:w-8/12 mx-auto">
            <!-- BEGIN: Company Information -->
            <div class="bg-white shadow-lg rounded-lg p-6 mt-10 lg:mt-0">
                <div class="border-b pb-4 mb-6">
                    <h2 class="font-semibold text-2xl text-gray-800">@translate(Organization Setup)</h2>
                </div>

                <form action="{{ route('org.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Image Upload Section -->
                    <div class="grid grid-cols-12 gap-6" id="logo">
                        <div class="col-span-12 xl:col-span-4">
                            <div class="border border-gray-300 rounded-md p-5 text-center">
                                <div class="w-40 h-40 relative mx-auto rounded-full overflow-hidden shadow-md">
                                    <div class="avatar-upload">
                                        <div class="avatar-preview bg-gray-200" style="background-image: url({{ maildollLogo() }});">
                                        </div>
                                    </div>
                                </div>
                                <label for="avatar-upload" class="cursor-pointer mt-4 inline-block text-center">
                                    <span class="block text-blue-500 hover:text-blue-600">@translate(Change Photo)</span>
                                    <input type="file" id="avatar-upload" name="avatar" accept=".png, .jpg, .jpeg" class="hidden">
                                </label>
                            </div>
                        </div>

                        <!-- Company Information Fields -->
                        <div class="col-span-12 xl:col-span-8">
                            <div class="mb-5">
                                <label class="text-gray-700">@translate(Company Name) <span class="text-red-500">*</span></label>
                                <input type="text" class="input w-full border border-gray-300 rounded-md mt-2 p-3 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" placeholder="@translate(Company Name)" name="company_name" required>
                            </div>

                            <div class="mb-5">
                                <label class="text-gray-700">@translate(Company Email) <span class="text-red-500">*</span></label>
                                <input type="email" class="input w-full border border-gray-300 rounded-md mt-2 p-3 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" placeholder="@translate(Company Email)" name="company_email" required>
                            </div>

                            <div class="mb-5">
                                <label class="text-gray-700">@translate(Company Phone Number) <span class="text-red-500">*</span></label>
                                <input type="text" class="input w-full border border-gray-300 rounded-md mt-2 p-3 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" placeholder="@translate(Company Phone Number)" name="company_phone_number" required>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Fields -->
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 xl:col-span-6">
                            <div class="mb-5">
                                <label class="text-gray-700">@translate(Company Telephone Number) <span class="text-gray-400">(optional)</span></label>
                                <input type="text" class="input w-full border border-gray-300 rounded-md mt-2 p-3 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" placeholder="@translate(Company Telephone Number)" name="company_tel_number">
                            </div>
                        </div>

                        <div class="col-span-12 xl:col-span-6">
                            <div class="mb-5">
                                <label class="text-gray-700">@translate(Company Address) <span class="text-gray-400">(optional)</span></label>
                                <input type="text" class="input w-full border border-gray-300 rounded-md mt-2 p-3 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" placeholder="@translate(Company Address)" name="company_address">
                            </div>
                        </div>
                    </div>

                    <!-- Test Connection Fields -->
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 xl:col-span-6">
                            <div class="mb-5">
                                <label class="text-gray-700">@translate(Test Connection Email) <span class="text-red-500">*</span></label>
                                <input type="email" class="input w-full border border-gray-300 rounded-md mt-2 p-3 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" placeholder="demo@maildoll.com" name="test_connection_email" required>
                            </div>
                        </div>

                        <div class="col-span-12 xl:col-span-6">
                            <div class="mb-5">
                                <label class="text-gray-700">@translate(Test Connection Sms Number) <span class="text-red-500">*</span></label>
                                <input type="text" class="input w-full border border-gray-300 rounded-md mt-2 p-3 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" placeholder="+8801825731327" name="test_connection_sms" required>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="button px-6 py-3 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition">Save and Next Step</button>
                    </div>
                </form>
            </div>
            <!-- END: Company Information -->
        </div>
    </div>
</div>





@endsection

@section('script')
<script src="{{ filePath('bladejs/install/setupOrg.js') }}"></script>
<script src="{{ filePath('assets/js/jquery.js') }}"></script>
<script src="{{ filePath('assets/js/parsley.js') }}"></script>
<script src="{{ filePath('assets/js/validation.js') }}"></script>

@endsection

