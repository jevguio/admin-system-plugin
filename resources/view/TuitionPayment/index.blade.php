<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'Test Plugin' }}
        </h2>

    </x-slot>

    {{-- Flash messages --}}
    @if (session('success'))
        <div id="success-alert"
            class="absolute top-0 right-0 bg-green-600 shadow mt-4 p-4 dark:bg-green-600 hover:bg-green-600">
            <div class="shadow text-green-800 dark:text-gray-200">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="error-alert" class="absolute top-0 right-0 bg-red-600 shadow mt-4 p-4 dark:bg-red-600 hover:bg-red-600">
            <div class="shadow text-red-800 dark:text-gray-200">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <h2>Tuition Payments</h2>
    <form method="POST" action="/tuition-payments">
        @csrf
        <input type="number" name="student_id" placeholder="Student ID" required>
        <input type="number" name="amount" placeholder="Amount" required>
        <input type="date" name="payment_date" required>
        <button type="submit">Submit Payment</button>
    </form>

    <ul>
        @foreach ($payments as $payment)
            <li>Student #{{ $payment->student_id }} paid ₱{{ $payment->amount }} on {{ $payment->payment_date }}</li>
        @endforeach
    </ul>

</x-app-layout>
