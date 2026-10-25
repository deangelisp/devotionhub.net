<table style="width: 100%; background-color: {!! $backgroundColor !!}; border-collapse: collapse; ">
    <tbody>
        <tr>
            <td style="padding: 0;">
                <table style="width: 600px; margin: 0 auto;  border-collapse: collapse; ">
                    <tr>
                        <td style="text-align: center; padding-top: 50px; padding-bottom: 40px;">
                            <a href="{!! $siteUrl !!}">
                                @if ($siteLogo)
                                    <img src="{!! $siteLogo !!}" style="width: 150px; height: auto;">
                                @else
                                    <h1 style="text-center">{!! $siteName !!}</h1>
                                @endif
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
