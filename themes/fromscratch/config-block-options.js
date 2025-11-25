function getContentMarginOptions(defaultValue = '') {
  return {
    type: 'select',
    label: 'Abstände',
    default: defaultValue,
    attributeName: 'contentMargin',
    options: [
      { label: 'Ohne', value: '' },
      { label: 'Sehr Klein', value: '-content-margin-xs' },
      { label: 'Klein', value: '-content-margin-s' },
      { label: 'Mittel', value: '-content-margin-m' },
      { label: 'Groß', value: '-content-margin-l' },
      { label: 'Sehr groß', value: '-content-margin-xl' }
    ]
  };
}

export const blockOptions = [
  {
    name: 'core/columns',
    options: [
      getContentMarginOptions('-content-margin-m'),
      {
        type: 'select',
        label: 'Spaltenabstand',
        default: '-column-gap-m',
        attributeName: 'columnGap',
        options: [
          { label: 'Sehr klein', value: '-column-gap-xs' },
          { label: 'Klein', value: '-column-gap-s' },
          { label: 'Normal', value: '-column-gap-m' },
          { label: 'Groß', value: '-column-gap-l' },
          { label: 'Sehr groß', value: '-column-gap-xl' }
        ]
      },
      {
        type: 'select',
        label: 'Design',
        default: '',
        attributeName: 'design',
        options: [
          { label: 'Standart', value: '' },
          { label: 'Bild links, Text rechts', value: '-image-left-text-right' },
          { label: 'Bild rechts, Text links', value: '-image-right-text-left' }
        ]
      },
      {
        type: 'boolean',
        label: 'Spalten umgekehrt auf Mobilgeräten',
        default: false,
        attributeName: 'columnReverseOrderOnMobile',
        className: '-reverse-order-on-mobile'
      }
    ]
  },
  {
    name: 'core/paragraph',
    options: [
      {
        type: 'select',
        label: 'Weite limitieren',
        default: '',
        attributeName: 'narrowParagraph',
        options: [
          { label: 'Ohne', value: '' },
          { label: 'Eng', value: '-narrow' },
          { label: 'Sehr Eng', value: '-very-narrow' }
        ]
      }
    ]
  },
  {
    name: 'core/column',
    options: [
      {
        type: 'boolean',
        label: 'Mit Hintergrundfarbe',
        default: false,
        attributeName: 'columnHasBackgroundColor',
        className: '-has-background-color'
      },
      {
        type: 'boolean',
        label: 'Inhalt zentrieren',
        default: false,
        attributeName: 'columnCenterContent',
        className: '-center-content'
      }
    ]
  },
  {
    name: 'core/image',
    options: [getContentMarginOptions()]
  },
  {
    name: 'core/group',
    options: [getContentMarginOptions('-content-margin-m')]
  },
  {
    name: 'core/separator',
    options: [getContentMarginOptions('-content-margin-m')]
  }
];
