@component('mail::message')
# İş Başvuru Formu

<p>Sayın yetkili, </p>
<p>Aşağıda bilgileri bulunan bir kullanıcı web sitesi üzerinden iş başvurusunda bulunuyor.</p>

<strong>Ad:</strong> {{ $variables['name'] }}<br>
<strong>Soyad:</strong> {{ $variables['surname'] }}<br>
<strong>Telefon:</strong> {{ $variables['phone'] }}<br>
<strong>E-posta:</strong> {{ $variables['email'] }}<br>
<strong>E-posta:</strong> {{ $variables['job_title'] }}<br>
@if(isset($variables['company_name']))
<strong>Firma Adı:</strong> {{ $variables['company_name'] }}<br>
@endif
@if(isset($variables['msg']))
<strong>Mesaj:</strong> {{ $variables['msg'] }}<br>
@endif


<strong>Egeria</strong>
@endcomponent
