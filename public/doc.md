Il suffit de quelques étapes pour obtenir l'aperçu parfait pour :
- WhatsApp
- Twitter
- Facebook
- bookmark icons for pc's and mobile devices

Si vous aimez lire, allez sur Open Graph (ogp.me) - mais assurez-vous de lire les étapes 1 à 6 de cette réponse pour obtenir le meilleur aperçu de WhatsApp.

Les résultats de nombreux audits techniques menés par différentes entreprises montrent que les balises Open Graph ne vous aideront pas à obtenir un meilleur classement dans les moteurs de recherche, car elles sont réservées aux médias sociaux. 

Ces balises Open Graph <meta> se placent à l'intérieur de la balise <head>.

Veuillez noter : @jaimish11 a mentionné que certaines applications ou sites web utilisent le cache ou même stockent l'aperçu du site web dans leur base de données. Cela signifie que lorsque vous testez votre lien dans WhatsApp ou Facebook par exemple, vous ne verrez probablement pas de différence tout de suite. L'utilisation d'un autre lien (une autre page) fera l'affaire. Mais dès que vous utilisez ce lien une fois, cette section "remarque" recommence.

Étape 1 : titre (Maximum de 65 caractères)
<title>your keyword rich title of the website and/or webpage</title>

Step 2: description (Maximum of 155 characters)
<meta name="description" content="description of your website/webpage, make sure you use keywords!" />

Step 3: og:title (Maximum 35 characters)
<meta property="og:title" content="short title of your website/webpage" />

Step 4: og:url (Full link to the current webpage address)
<meta property="og:url" content="https://www.example.com/webpage/" />

Step 5: og:description (Maximum 65 characters)
<meta property="og:description" content="description of your website/webpage" />

Step 6: og:image 
    Image(JPG or PNG) with a size less than 300KB and minimum dimensions of 300 x 200 *. This image should be served via a HTTPS connection with a valid non-self-signed certificate.**

<meta property="og:image" content="//cdn.example.com/uploads/images/webpage_300x200.png" />
* @RichDeBourke mentioned this to me, but apparently WhatsApp has increased its maximum image size (dimensions as well as file size). I did some tests: it does not work consistently every time on every device. I tested 2.x Mb images and even that seemed to work 9/10 times. 300KB is the safest approach, but you should be fine using larger images as of 18-02-2020. I would recommend keeping the file size below 2MB, though. And definitely throw your image through TinyPNG or any other image compression algorithm if you haven't already.

** @Indraraj mentioned the image may not show up if your site runs on https with a self-signed certificate.

If you completed the steps above, you can now see your preview in WhatsApp! However, be aware of the "please note" section above.

Step 7: og:type

In order for your object to be represented within the graph, you need to specify its type. Here's a list of the global types available: http://ogp.me/#types. You can also specify your own types.

<meta property="og:type" content="article" />


Step 8: og:locale 

The locale of the resource. You can also use og:locale:alternate if you have other language translations available.

If you don't specify og:locale, it defaults to en_US.

<meta property="og:locale" content="en_GB" />
<meta property="og:locale:alternate" content="fr_FR" />
<meta property="og:locale:alternate" content="es_ES" />

Step 9: Twitter
For the best Twitter support read this.

Step 10: Facebook
For the best Facebook support read this.

Step 11: favicon
For the best favicon support for all browsers and devices read this.

Bonus step 12: video/audio

It's also possible to share audio/video. Facebook and Twitter for example share videos very well. Read ogp.me. And of course WhatsApp has this option as well: when you share an Instagram or Youtube link, the WhatsApp preview comes with the in-app video player.

Super bonus step 13: products, persons, movies etc.

This kind of information really depends on the provider (Facebook, Google). I don't know when, but WhatsApp and Twitter could enable support for products. This way, the persons you share the link with, might see the price, average review score in the shared link "widget". That would be nice. This already exists for business accounts who have their Catalog up-to-date in their WhatsApp Business app, but this is totally different than link sharing.