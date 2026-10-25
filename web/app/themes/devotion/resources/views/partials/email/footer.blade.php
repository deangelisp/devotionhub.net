<tr>
    <td style=" padding: 0;  ">
        <table style="width: 600px;  border-collapse: collapse; margin: 0 auto;   color: {!! $footerTextColor !!}; ">

            <td style="padding-top: 40px; "></td>

            {{-- Logo --}}
            @if ($footerLogoUrl)
                <tr>
                    <td style="text-align: center;padding-bottom: 10px;">
                        <a href="{!! $siteUrl !!}">
                            <img src="{!! $footerLogoUrl !!}" alt="Logo Footer" width="160"
                                style="margin: 0 auto" /></a>
                    </td>
                </tr>
            @endif

            {{-- Links --}}
            @if (!empty($links))
                <tr>
                    <td
                        style="color: {!! $footerTextColor !!}; font-size: 12px; font-weight: bold; line-height: 18px; text-align: center; font-family: Roboto,sans-serif;  padding-bottom: 15px;">
                        @foreach ($links as $key => $item)
                            <span>
                                @if (!$loop->first)
                                    <span> | </span>
                                @endif
                                <a style="color: {!! $footerTextColor !!}; text-decoration: none !important;"
                                    href="{!! $item['link']['url'] !!}">
                                    {!! $item['link']['title'] !!}
                                </a>
                            </span>
                        @endforeach
                    </td>
                </tr>
            @endif


            {{-- Social Medias --}}
            @if (!empty($siteSocialMedias))
                <tr>
                    <td align="center" style="padding-bottom: 15px;">
                        <table>
                            <tr>

                                @foreach ($siteSocialMedias as $item)
                                    <td style="padding: 0 3px">
                                        <a href="{!! $item['url'] !!}" title="{!! $item['media'] !!}"
                                            aria-label="{!! $item['media'] !!}" target="_blank">
                                            {{-- @svg("images.svg.social-media.{$item['media']}", false, ['style' => 'width: 16px; height: 16px; fill: ' . $footerTextColor . ';']) --}}
                                            <?php $asset = \Roots\asset('images/email/' . $item['media'] . '.png'); ?>
                                            <img src="{!! $asset->uri() !!}" style="width: 16px; height: 16px;" />
                                        </a>
                                    </td>
                                @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>
            @endif


            {{-- Message --}}
            @if (!empty($message))
                <tr>
                    <td
                        style="color: {!! $footerTextColor !!}; font-size: 12px; line-height: 18px; text-align: center; font-family: Roboto,sans-serif;  padding-bottom: 10px;">
                        <span style="display: inline-block; max-width: 380px;">
                            {!! $message !!}
                        </span>
                    </td>
                </tr>
            @endif


            {{-- CTA PHONE --}}
            @if (!empty($sitePhoneNumber))
                <tr>
                    <td
                        style="color: {!! $footerTextColor !!}; font-size: 12px; line-height: 18px; text-align: center; font-family: Roboto,sans-serif; padding-bottom: 20px;">
                        Call us on <a style="color: {!! $footerTextColor !!}; text-decoration: none !important;"
                            href="{!! generate_tel_url($sitePhoneNumber) !!}">
                            {!! $sitePhoneNumber !!}
                        </a>
                    </td>
                </tr>
            @endif

            <!-- Copyright -->
            @if (!empty($copyright))
                <tr>
                    <td
                        style="color: {!! $footerTextColor !!}; font-size: 12px; line-height: 18px; text-align: center; font-family: Roboto,sans-serif; ">
                        {!! $copyright !!}
                    </td>
                </tr>
            @endif
            <td style="padding-bottom: 40px; "></td>
        </table>
    </td>
</tr>
<tbody>
    </table>
