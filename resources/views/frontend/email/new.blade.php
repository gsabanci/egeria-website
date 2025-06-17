@component('mail::message')
# Talep Formu

<p>Sayın yetkili, </p>
<p>Aşağıda bilgileri bulunan bir kullanıcı sizlere web sitesi üzerinden talep formu gönderiyor.</p>

<strong>Ad:</strong> {{ $variables['name'] }}<br>
<strong>Soyad:</strong> {{ $variables['surname'] }}<br>
<strong>Telefon:</strong> {{ $variables['phone'] }}<br>
<strong>E-posta:</strong> {{ $variables['email'] }}<br>
@if(isset($variables['company_name']))
<strong>Firma Adı:</strong> {{ $variables['company_name'] }}<br>
@endif
@if(isset($variables['msg']))
<strong>Mesaj:</strong> {{ $variables['msg'] }}<br>
@endif


<strong>Egeria</strong>
@endcomponent
