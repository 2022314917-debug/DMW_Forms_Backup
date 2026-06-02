<h3>Request Form Reviewed</h3>
<p>Dear {{ $recipientName }},</p>

<p>Good day!</p>

<p>This is to confirm that we have successfully reviewed your submission. Below are the links of the forms you need to submit for request <strong>#{{ $requestId }}</strong>:</p>

<p>Please complete your required form(s) by clicking the link below:</p>

<p>
    @foreach($selectedForms as $form)
        <a href="{{ $form['url'] }}">{{ $form['label'] }}</a>
    @endforeach
</p>

<p>Please follow the links above to complete the required form(s) as soon as possible.</p>

<p>Thank you for cooperating. We appreciate your cooperation.</p>

<p>Best regards,</p>
<p>Department of Migrant Workers</p>
<p>rjdavid061504@gmail.com</p>