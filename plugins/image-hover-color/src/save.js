const { useBlockProps } = wp.blockEditor;

const Save = ({ attributes }) => {
    const { imageUrl, overlayText = 'Ваш текст', imageSize = 100, showOverlay = true } = attributes;

    // Добавляем console.log для отладки
    console.log('Attributes in Save Component', { imageUrl, overlayText, imageSize, showOverlay });

    return (
        <div className="image-hover-outer" {...useBlockProps.save()}>
            {imageUrl && (
                <div className="image-hover" style={{ position: 'relative', display: 'inline-block', maxWidth: '100%', overflow: 'hidden' }}>
                    <img
                        className="normal-image"
                        src={imageUrl}
                        alt={overlayText}
                        style={{
                            width: `${imageSize}%`,
                            height: 'auto',
                            transition: 'transform 0.5s',
                        }}
                    />
                    {showOverlay && ( // Проверяем, нужно ли отображать наложение
                        <div className="overlay" style={{ position: 'absolute', top: 0, left: 0, width: `${imageSize}%`, height: '100%' }}>
                            <div className="overlay-content">
                                <p>{overlayText}</p>
                            </div>
                        </div>
                    )}
                </div>
            )}
        </div>
    );
};

export default Save;