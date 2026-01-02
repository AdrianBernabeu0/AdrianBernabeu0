import globals from 'globals';
import pluginJs from '@eslint/js';
import pluginVue from 'eslint-plugin-vue';

/** @type {import('eslint').Linter.Config[]} */
export default [
  {
    files: ['**/*.js'],
    languageOptions: {
      sourceType: 'script',
      globals: globals.browser,
    },
  },
  pluginJs.configs.recommended,
  ...pluginVue.configs['flat/recommended'],
  {
    files: ['**/*.vue'],
    languageOptions: {
      parser: 'vue-eslint-parser',
      parserOptions: {
        ecmaVersion: 'latest',
        sourceType: 'module',
      },
    },
    rules: {
      // Aplicar pràctiques modernes d'acord amb ES6
      'prefer-const': 'error', // Preferir const per a variables que no es reassignen
      'no-var': 'error', // Rebutjar l'ús de var
      'arrow-body-style': ['error', 'as-needed'], // Aplicar funcions fletxa concises
      'prefer-arrow-callback': 'error', // Preferir funcions fletxa com a callbacks

      // Aplicar l'ús de querySelector/querySelectorAll
      'no-restricted-syntax': [
        'error',
        {
          selector: 'CallExpression[callee.name="getElementById"]',
          message: 'Utilitza querySelector o querySelectorAll en comptes de getElementById.',
        },
      ],

      // Organització de codi
      'max-lines-per-function': ['warn', { max: 50 }], // Limitar el nombre de línies per funció

      // Evitar números màgics
      'no-magic-numbers': ['warn', { ignore: [0, 1] }],

      // Convencions de nomenclatura
      'id-length': ['warn', { min: 2 }], // Obligar a posar noms descriptius
      camelcase: 'error', // Obligar a posar la nomenclatura camelCase

      
    // Regles específiques de Vue.js
    'vue/multi-word-component-names': 'error', // Requerir que els noms dels components siguin de múltiples paraules
    'vue/attributes-order': 'warn', // Obligar a donar ordre dels atributs en els components
    'vue/order-in-components': 'warn', // Obligar a donar ordre de les propietats dins dels components
    'vue/html-self-closing': [
      'error',
      { // Obligar a donar estil d'auto-tancament en els elements HTML
        html: {
          void: 'never',
          normal: 'always',
          component: 'always',
        },
        svg: 'always',
        math: 'always',
      },
    ], 
  },
},
];