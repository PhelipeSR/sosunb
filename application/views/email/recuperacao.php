<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Recuperação de Senha- SOS UnB</title>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge' />
	<style type='text/css'>
		body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
		table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;}
		img{-ms-interpolation-mode: bicubic;}
		img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
		table{border-collapse: collapse !important;}
		body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
		a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: none !important;
			font-size: inherit !important;
			font-family: inherit !important;
			font-weight: inherit !important;
			line-height: inherit !important;
		}
		@media screen and (max-width: 525px) {
			.wrapper {
				width: 100% !important;
				max-width: 100% !important;
			}
			.logo img {
				margin: 0 auto !important;
			}
			.responsive-table {
				width: 100% !important;
			}
			.padding {
				padding: 10px 5% 15px 5% !important;
			}
			.padding-copy {
				padding: 10px 5% 10px 5% !important;
				text-align: center;
			}
			.mobile-button-container {
				margin: 0 auto;
				width: 100% !important;
			}
			.mobile-button {
				padding: 15px !important;
				border: 0 !important;
				font-size: 16px !important;
				display: block !important;
			}
		}
		div[style*='margin: 16px 0;'] { margin: 0 !important; }
	</style>
	</head>
	<body style='margin: 0 !important; padding: 0 !important;'>

		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
			<tr>
				<td bgcolor='#ffffff' align='center' style='padding: 15px;'>
					<table border='0' cellpadding='0' cellspacing='0' width='500' class='responsive-table' style="border: solid black 2px">
						<tr>
							<td>
								<table width='100%' border='0' cellspacing='0' cellpadding='0'>
									<tr>
										<td align='center' style='padding: 5px; background-color: #fff'><img style="max-height: 100px" src="http://sosunb.000webhostapp.com/api/assets/images/logo.png"></td>
									</tr>
									<tr>
										<td align='center' style='font-size: 32px; font-family: Helvetica, Arial, sans-serif; color: #333333;' class='padding-copy'>Recuperação de Conta </td>
									</tr>
									<tr>
										<td align='left' style='padding: 20px 20px 0 20px; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding-copy'>Recebemos uma tentativa de recuperação de senha para este e-mail. Caso não tenha sido você, desconsidere, caso contrário clique no link abaixo.<br><br></td>
									</tr>
									<tr>
										<td align='center'>
											<table width='100%' border='0' cellspacing='0' cellpadding='0'>
												<tr>
													<td align='center' style='padding: 25px 0;' class='padding'>
														<table border='0' cellspacing='0' cellpadding='0' class='mobile-button-container'>
															<tr>
																<td align='center' style='border-radius: 3px;' bgcolor='#114177'><a href="<?php echo $link; ?>" target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #4988d0; display: inline-block;' class='mobile-button'>Recuperar Conta</a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>