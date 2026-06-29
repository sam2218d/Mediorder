<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful - MediOrder</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fafafa] font-sans text-gray-900 min-h-screen flex flex-col items-center justify-center p-6">

    <div class="max-w-md w-full bg-white rounded-[24px] p-10 shadow-sm border border-gray-100 text-center">
        
        <div class="w-24 h-24 bg-[#00a86b]/10 text-[#00a86b] rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </div>

        <h1 class="text-2xl font-black text-gray-900 mb-2">Order Received!</h1>
        
        <p class="text-gray-500 text-sm mb-8 leading-relaxed">
            Thank you for choosing MediOrder. We have successfully received your prescription and payment proof.
        </p>

        <div class="bg-gray-50 rounded-xl p-5 mb-8 border border-gray-100 text-left">
            <div class="flex justify-between items-center mb-3">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Order Number</span>
                <span class="text-sm font-black text-gray-900">#ORD-{{ str_pad($orderId, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex justify-between items-center mb-3">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Status</span>
                <span class="text-xs font-bold text-yellow-600 bg-yellow-100 px-2 py-1 rounded-md">Pending Verification</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Estimated Delivery</span>
                <span class="text-sm font-bold text-gray-900">2-3 Business Days</span>
            </div>
        </div>

        <h3 class="text-sm font-bold text-gray-900 mb-2">What happens next?</h3>
        <p class="text-xs text-gray-500 mb-8">
            Our certified pharmacists will review your prescription and verify your payment shortly. You will receive an email update once your order is shipped.
        </p>

        <a href="/" class="w-full bg-[#00a86b] hover:bg-[#00905a] transition-colors text-white font-bold py-3.5 rounded-xl flex justify-center items-center shadow-sm">
            Continue Shopping
        </a>

    </div>

    <p class="text-xs font-medium text-gray-400 mt-8">
        Need help? Contact support at support@mediorder.com
    </p>

</body>
</html>