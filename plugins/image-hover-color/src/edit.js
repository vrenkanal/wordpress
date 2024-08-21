import { MediaUpload, MediaUploadCheck, useBlockProps } from '@wordpress/block-editor';
import { Button, RangeControl, TextControl, ToggleControl } from '@wordpress/components';

const Edit = ({ attributes, setAttributes }) => {
    const { imageUrl, overlayText = 'Ваш текст', imageSize = 100, showOverlay = true } = attributes;

    const updateOverlayText = (newText) => {
        setAttributes({ overlayText: newText });
    };

    const updateImageSize = (newSize) => {
        setAttributes({ imageSize: newSize });
    };

    const toggleOverlay = () => {
        setAttributes({ showOverlay: !showOverlay });
    };

    return (
        <div className="image-hover-outer" {...useBlockProps()}>
            <MediaUploadCheck>
                <MediaUpload
                    onSelect={(media) => {
                        //console.log(media); // Добавлено для отладки
                        setAttributes({ imageUrl: media.url });
                    }}
                    allowedTypes={['image']}
                    render={({ open }) => (
                        <Button
                            onClick={open}
                            className={imageUrl ? 'button button-large' : 'button button-large button-secondary'}
                            aria-label={imageUrl ? 'Изображение выбрано' : 'Выберите изображение'}
                        >
                            {imageUrl ? 'Изображение выбрано' : 'Выберите изображение'}
                        </Button>
                    )}
                />
            </MediaUploadCheck>

            {imageUrl && (
                <div className="image-hover">
                    <img
                        className="normal-image"
                        src={imageUrl}
                        alt="Изображение"
                        style={{
                            width: `${imageSize}%`,
                            height: 'auto'
                        }}
                    />
                    {showOverlay && (
                        <div className="overlay">
                            <div className="overlay-content">
                                <p>{overlayText}</p>
                            </div>
                        </div>
                    )}
                </div>
            )}

            {imageUrl && (
                <>
                    <RangeControl
                        label="Размер изображения"
                        value={imageSize}
                        onChange={updateImageSize}
                        min={10}
                        max={100}
                    />
                    <TextControl
                        label="Текст наложения"
                        value={overlayText}
                        onChange={updateOverlayText}
                    />
                    <ToggleControl
                        label="Отображать наложение"
                        checked={showOverlay}
                        onChange={toggleOverlay}
                    />
                </>
            )}
        </div>
    );
};

export default Edit;