<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Registration</title>
    <script src="/index.global.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-6 rounded-lg shadow-lg flex w-3/4">
        <!-- Left Side (Image) -->
        <div class="w-1/2 flex items-center justify-center">
            <img src="/african-american-woman-pharmacist-smiling-confident-standing-pharmacy.jpg" alt="Pharmacy Image" class="rounded-lg shadow-md">
        </div>

        <!-- Right Side (Form) -->
        <div class="w-1/2 p-6">
            <h2 class="text-2xl font-bold mb-4 text-center">Register Pharmacy</h2>

            <!-- Flash Message Alert -->
            @if (isset($success))
                <div class="p-3 mb-3 text-white bg-green-500 rounded">
                    {{ $success }}
                </div>
            @elseif(session('error'))
                <div class="p-3 mb-3 text-white bg-red-500 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('register.pharmacy') }}" method="POST">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold">Pharmacy Name</label>
                        <input type="text" name="pharmacy_name" class="w-full border p-2 rounded" placeholder="Pharmacy Name" required>
                    </div>
                    <div>
                        <label class="block font-semibold">First Name</label>
                        <input type="text" name="firstname" class="w-full border p-2 rounded" placeholder="First Name" required>
                    </div>
                    <div>
                        <label class="block font-semibold">Last Name</label>
                        <input type="text" name="lastname" class="w-full border p-2 rounded" placeholder="Last Name" required>
                    </div>
                    <div>
                        <label class="block font-semibold">Phone</label>
                        <input type="text" name="phone" class="w-full border p-2 rounded" placeholder="Phone" required>
                    </div>
                    <div>
                        <label class="block font-semibold">Email</label>
                        <input type="email" name="email" class="w-full border p-2 rounded" placeholder="Email" required>
                    </div>
                    <div>
                        <label class="block font-semibold">Password</label>
                        <input type="password" name="password" class="w-full border p-2 rounded" placeholder="Password" required>
                    </div>
                    <div>
                        <label class="block font-semibold">Address</label>
                        <input type="text" name="address" class="w-full border p-2 rounded" placeholder="Address" required>
                    </div>
                    <div>
                        <label class="block font-semibold">City</label>
                        <input type="text" name="city" class="w-full border p-2 rounded" placeholder="City" required>
                    </div>
                </div>

                <button type="submit" class="bg-blue-500 text-white p-2 w-full rounded mt-4">Register</button>
            </form>
        </div>
    </div>

</body>
</html>
