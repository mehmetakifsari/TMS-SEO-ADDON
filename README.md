# TMS-SEO-ADDON

TMS WHMCS Free SEO Addon - No license - No encryption - Description - Title - Meta


#####################################################################################

###########################  --- KURULUM TÜRKÇE ANLATIM --- #########################

#####################################################################################

Dil seçeneğinize göre modülünüzü seçip dosyayı whmcs modül klasorune yükleyiniz.

Örnek yükleme şekli : 

1- ) Örneğin herhangi bir dildeki modülü seçtim ve kurulum yapmak istiyorum.

2- ) FTP'den siteme bağlantı sağladım ve whmcsnin kurulu oldugu dizine girdim.

3- ) turkce-seo-modulu adlı dosyanın içindeki modules klasorunu whmcsnin kurulu oldugu dizine attım. 

4- ) WHMCS tema dosyanızı bulun /templates/{temaismi}/header.tpl   | temanızın header.tpl dosyasına aşağıdaki kodları en üstün bir alt satırına ekliyoruz ekledikten sonra siteye yüklüyoruz.

    <title>{if $seotitle eq ""} {if $kbarticle.title}{$kbarticle.title} - {/if}{$companyname} - {$pagetitle} {else} {$seotitle} {/if}</title>
    <meta name="keywords" content="{$seokeyword}">
    <meta name="description" content="{$seodecription}">
    <meta property="og:url" content="{$fburl}" />
    <meta property="og:type" content="{$fbtype}" />
    <meta property="og:title" content="{$fbtitle}" />
    <meta property="og:description" content="{$fbdesc}" />
    <meta property="og:image" content="{$fbimage}" />

5- ) WHMCS Panelinizden - Kurulum menüsünden Eklenti & Modüller bölümünden medyatika seo eklentisini aktif edebilirsiniz ve kullanmaya başlayabilirsiniz.

#####################################################################################

------------------------------------------------------------------------------------

#####################################################################################

###########################  --- INSTALLATION ENGLISH EXPRESSION --- ################

#####################################################################################

> 1. Upload Files.

Upload module directory to WHMCS root installation folder.
> 2. Open /templates/{templatename}/header.tpl and add following lines

    `<title>{if $seotitle eq ""} {if $kbarticle.title}{$kbarticle.title} - {/if}{$companyname} - {$pagetitle} {else} {$seotitle} {/if}</title>
    <meta name="keywords" content="{$seokeyword}">
    <meta name="description" content="{$seodecription}">
    <meta property="og:url" content="{$fburl}" />
    <meta property="og:type" content="{$fbtype}" />
    <meta property="og:title" content="{$fbtitle}" />
    <meta property="og:description" content="{$fbdesc}" />
    <meta property="og:image" content="{$fbimage}" />`
** 3. Activate eWallHost WHMCS SEO Module.

    Log in to WHMCS Admin Panel . Go to  'Setup' -> 'Addon Modules'. Find '.com SEO Addon' and then click 'Activate' button. Click ‘Configure’ Button enable check boxes of WHMCS Roles and press 'Save Changes'.
