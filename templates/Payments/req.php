
<form action="" id="payment-form">
    <div id="payment-element"> </div>
    <button type="submit">pay</button>
    <div id="error-messages"></div>
</form>

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('pk_test_51HvjfMECzoeV8ioGVbYCiBXVSi2pPXQd06zYXz7KBVtsvF1K4UlFIiobud5GV2eJh3EUPA2lOeWMM5tF0fs2vtWJ00w2XqVekT');
    const elements = stripe.elements({
        clientSecret: '<?= $paymentIntent->client_secret ?>'
    });
    const paymentElement = elements.create('payment');
    paymentElement.mount('#payment-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const {error} = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: "<?= $this->Url->build(['controller' => 'Payments', 'action' => 'complete', '?' => ['client_id' => $client_id, 'invoice' => $invoice, 'order_address' => $order_address]], ['fullBase' => true, 'escape' => false]) ?>",
            }
        })

        if (error) {
            document.getElementById('error-messages').innerText = error.message;
        }

    });
</script>