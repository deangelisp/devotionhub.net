<tr>
    <td style="padding: 0;">
        <table style="width: 600px; margin: 0 auto; background-color: #FFF; border-collapse: collapse; ">
            <tr>
                <td
                    style="text-align: center;font-family: Roboto,sans-serif;font-size: 29px;line-height: 39px;color: #5a5a5a;font-weight: 600; ">
                    <span style="display: inline-block; max-width: 400px;">
                        Welcome to {!! $siteName !!}!
                    </span>
                </td>
            </tr>
            <tr>
                <td
                    style="text-align: center;font-family: Roboto,sans-serif;font-size: 16px;line-height: 23px;color: #5a5a5a; padding-top: 20px;">
                    <span style="display: inline-block; max-width: 500px;">
                        Here's how to log in:<br /><br />
                        Username: <strong>{!! $user->display_name !!}</strong><br />
                        Password: For security reason, we save encripted password<br />
                    </span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; padding-top: 20px; padding-bottom: 40px;">
                    <a href="{!! $siteUrl !!}"
                        style="display: inline-block;text-align: center;font-family: Roboto,sans-serif;font-size: 16px;color: #FFF;background-color: {!! $featureColor !!};padding: 12px 20px;font-weight: bold;text-decoration: none;border-radius: 8px;">
                        Access the Login Page
                    </a>
                </td>
            </tr>
            <tr>
                <td
                    style="text-align: left; padding: 20px; background-color: #f1f1f1; font-size: 11px; color: #000; font-family: Roboto,sans-serif;">
                    <strong>Trouble clicking?</strong> Copy and paste this URL into your browser:<br />
                    <a style="text-decoration: underline; color: #2585b2;" href="{!! $siteUrl !!}">
                        {!! $siteUrl !!}
                    </a>
                </td>
            </tr>
        </table>
    </td>
</tr>
