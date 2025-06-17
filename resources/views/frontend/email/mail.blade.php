<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
  <title>Egeria</title>
  <!-- <link href="../Desktop/fonts/sanfrancisco.css" rel="stylesheet" /> -->
  <!-- <link href="https://getlemy.com/storage/mailFiles/fonts/sanfrancisco.css" rel="stylesheet" /> -->
  <link href="https://cdn.jsdelivr.net/gh/mailtoharshit/San-Francisco-Font-/sanfrancisco.css" rel="stylesheet" />
</head>

<body style="margin: 0">
  <table style="
				border-collapse: collapse;
				border-spacing: 0;
				height: 100%;
				margin: 0;
				padding: 0;
				vertical-align: top;
				width: 100%;
				background-image: url(https://getlemy.com/front/images/general/lemy-transparent.png);
				background-repeat: no-repeat;
				background-position: right 30px;
				background-size: contain;
				background-color: #fff;
			">
    <tbody>
      <tr style="padding: 0; vertical-align: top">
        <td align="center" valign="top" style="margin: 0; padding: 0; text-align: center; vertical-align: top">
          <center style="min-width: 640px; width: 100%">
            <table
              style="border-collapse: collapse; border-spacing: 0; margin: 0 auto; padding: 25px 0 0; text-align: inherit; vertical-align: top; width: 640px">
              <tbody>
                <tr style="padding: 0; vertical-align: top" align="left">
                  <td style="margin: 0; padding: 0; vertical-align: top" align="left" valign="top">
                    <table
                      style="border-collapse: collapse; border-spacing: 0; margin: 0 auto; padding: 0; vertical-align: top; width: 640px">
                      <tbody>
                        <tr style="padding: 0; vertical-align: top" align="center">
                          <td style="margin: 0; min-width: 0; padding: 0 10px 10px 0; vertical-align: top; width: 50%"
                            align="center" valign="top">
                            <a href="https://egeria.com.tr/" style="color: #2ba6cb; text-decoration: none"
                              target="_blank"><img width="145" height="48"
                                src="{{ asset('/frontend/assets/images/mail.png') }}" alt="egeria.com.tr" s
                                style="border: none; clear: both; display: block; max-width: 100%; outline: none; text-decoration: none; width: auto; margin: 20px"
                                align="center" /></a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr style="padding: 0; vertical-align: top" align="left">
                  <td style="margin: 0; padding: 0; vertical-align: top" align="left" valign="top">
                    <table
                      style="border-collapse: collapse; border-spacing: 0; display: block; padding: 0; vertical-align: top; width: 100%; margin: 35px 0">
                      <tbody>
                        <tr style="padding: 0; vertical-align: top" align="left">
                          <td style="margin: 0; padding: 0 0 10px; vertical-align: top" align="center" valign="top">
                            <table width="640" border="0" cellpadding="0" cellspacing="0">
                              <tbody>
                                <tr style="margin-bottom: 15px">
                                  <td style="position: relative; text-align: center">
                                    <h1 style="color: #000930; font-weight: 600; margin: 12px">TALEP FORMU
                                    </h1>
                                  </td>
                                </tr>
                                <tr style="margin-bottom: 15px">
                                  <td style="position: relative; text-align: center">
                                    <p style="color: #9ea4be; font-size: 19px; font-weight: 400; line-height: 25px">
                                      İsim:{{ $name }}<br>
                                      Soyisim:{{ $surname }}<br>
                                      Telefon:{{ $phone }}<br>
                                      E-mail:{{ $email }}<br>
                                      Şirket Adı:{{ $company_name }}<br>
                                      Mesaj:{{ $msg }}<br>
                                    </p>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </center>
        </td>
      </tr>
    </tbody>
  </table>
</body>

</html>