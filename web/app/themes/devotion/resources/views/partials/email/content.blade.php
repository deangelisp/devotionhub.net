<tr>
    <td style="padding: 0;">
        <table
            style="width: 600px; margin: 0 auto; background-color: #FFF; border-collapse: initial; border-radius: 12px; border: 1px solid #FFF;">
            <tr>
                <td
                    style="font-family: 'Montserrat','Arial',sans-serif;font-size: 14px; padding: 20px 20px 20px 20px; color: #2b2b2b; ">
                    {!! $content !!}
                </td>
            </tr>
        </table>
    </td>
</tr>
@if (isset($unsubscribe) && $unsubscribe)
    <tr>
        <td style="padding: 0;">
            <table style="width: 600px; margin: 0 auto; border-collapse: collapse; ">
                <tr>
                    <td
                        style="font-family: 'Montserrat','Arial',sans-serif;font-size: 12px; padding: 20px 20px 0 20px; color: #2b2b2b; ">
                        <p style="text-align: center; margin: 0;">If you no longer wish to receive these emails,
                            you can
                            <a href="{{ $unsubscribe }}"
                                style="color: #2b2b2b; text-decoration: underline;">unsubscribe</a>
                            at any time.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endif
