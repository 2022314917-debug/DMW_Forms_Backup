<h3>Form Submission Successful</h3>
<p>Dear {{ $ofw_full_name }},</p>

<p>Good day!</p>

<p>This is to confirm that we have successfully received your submitted form(s). Below are the details of the information you provided.</p>

<p>
    <strong>Submitted Forms:</strong>
</p>

<ul>
    @foreach($form_names as $form)
        <li>{{ $form }}</li>
    @endforeach
</ul>

<p>
    <strong>Submission Details:</strong>
</p>
    
<ul>
    <li>Date Submitted: {{ $dateSubmitted }}</li>
    <li>Request Number: {{ $requestId }}</li>
</ul>

<p>Your submission is now under review by our team. If any additional information or clarification is needed,
     we will contact you immediately.
</p>

<p>Thank you for completing the required forms. We appreciate your cooperation.</p>

<p>Best regards,</p>
<p>Department of Migrant Workers</p>
<p>rjdavid061504@gmail.com</p>