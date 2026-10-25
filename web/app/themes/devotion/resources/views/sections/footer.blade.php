@if ($footer == 'Footer7')
    <x-blocks.footer.footer7 :logo="$footerLogo" :copyright="$copyright" />
@else
    <x-blocks.footer.footer3 :logo="$footerLogo" :socials="$siteSocialMedias" :copyright="$copyright" :address="$address" :phone="$phone"
        :email="$email" />
@endif
