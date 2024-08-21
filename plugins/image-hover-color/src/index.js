/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/

import { registerBlockType } from '@wordpress/blocks';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css

import './style.scss';

/**
 * Internal dependencies

import Edit from './edit';
import save from './save';
import metadata from './block.json';

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/

registerBlockType( metadata.name, {
	/**
	 * @see ./edit.js

	edit: Edit,

	/**
	 * @see ./save.js

	save,
} );
*/

/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */

import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';  // Проверьте, что путь правильный
import Save from './save';  // Проверьте, что путь правильный
//import './style.scss';      // Импорт стилей блока
import metadata from './block.json'; // Импорт метаданных блока

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
registerBlockType(metadata.name, {
    title: metadata.title,  // Извлекаем заголовок из метаданных
    description: metadata.description,  // Извлекаем описание из метаданных
    category: metadata.category,  // Извлекаем категорию из метаданных
    icon: metadata.icon,  // Извлекаем иконку из метаданных
    attributes: {
        imageUrl: {
            type: 'string',
            source: 'attribute',
            selector: 'img',
            attribute: 'src',
        },
        overlayText: {
            type: 'string',
            default: 'Ваш текст',
        },
        imageSize: {
            type: 'number',
            default: 100,
        },
    },
    edit: Edit,
    save: Save,
});
