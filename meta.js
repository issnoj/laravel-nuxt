module.exports = {
  defaults() {
    return [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { name: 'theme-color', content: '#ffffff' },
      {
        hid: 'description',
        name: 'description',
        content: 'Laravel-nuxt Sample Application'
      },
      {
        hid: 'og:title',
        name: 'og:title',
        property: 'og:title',
        content: 'Laravel + Nuxt.js'
      },
      {
        hid: 'og:type',
        name: 'og:type',
        property: 'og:type',
        content: 'article'
      },
      {
        hid: 'og:url',
        name: 'og:url',
        property: 'og:url',
        content: ''
      },
      {
        hid: 'og:description',
        name: 'og:description',
        property: 'og:description',
        content: ''
      },
      {
        hid: 'og:image',
        name: 'og:image',
        property: 'og:image',
        content: ''
      },
      {
        hid: 'twitter:card',
        name: 'twitter:card',
        content: 'summary'
      },
      {
        hid: 'twitter:site',
        name: 'twitter:site',
        content: ''
      }
    ];
  }
};
