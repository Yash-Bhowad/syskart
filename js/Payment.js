function payNow() {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const contact = document.getElementById("contact").value;
    const amount = document.getElementById("amount").value;

    if (!name || !email || !contact || !amount) {
        alert("Please fill all fields");
        return;
    }

    const options = {
        key: "rzp_test_KENEwuIZpo2nMq", // Replace with your Razorpay Key ID
        amount: amount * 100, // In paise
        currency: "INR",
        name: "SySkart",
        description: "Order Payment",
        image: "https://yourlogo.png", // Optional
        handler: function (response) {
            // Redirect to PHP for verification or confirmation
            window.location.href = "payment_process.php?payment_id=" + response.razorpay_payment_id;
        },
        prefill: {
            name: name,
            email: email,
            contact: contact
        },
        notes: {
            address: "SySkart Customer"
        },
        theme: {
            color: "#528FF0"
        }
    };

    const rzp = new Razorpay(options);
    rzp.open();
}