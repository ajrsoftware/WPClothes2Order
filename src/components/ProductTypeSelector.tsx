import { FC, useState, ChangeEvent } from 'react';
import * as D from '../ts/data';
import * as T from '../ts/types';
import * as H from '../ts/helpers';

const ProductTypeSelector: FC<T.ProductTypeSelectorProps> = ({
    type,
    position,
    width
}) => {
    const availableTypes = D.clothingTypes;
    const [chosenType, setChosenType] = useState(type ?? availableTypes[0]);

    return (
        <div className="product-type-selector">
            <div>
                <label htmlFor="_wpc2o_chosen_type" className="selector-label">
                    <span className="selector-header">
                        Select which <strong>type</strong> of product this is
                    </span>
                    <select
                        name="_wpc2o_chosen_type"
                        id="_wpc2o_chosen_type"
                        className="select short selectProductType"
                        disabled={availableTypes.length <= 0}
                        onChange={(event: ChangeEvent<HTMLSelectElement>) => {
                            setChosenType(event.target.value as T.ClothingType);
                        }}
                    >
                        {availableTypes.map((type) => (
                            <option key={type} value={type}>
                                {H.camelToText(type)}
                            </option>
                        ))}
                    </select>
                </label>
            </div>

            <PositionSelector
                key={chosenType}
                initial={position}
                initialWidth={width ? parseInt(width, 10) : undefined}
                type={chosenType}
            />
        </div>
    );
};

const PositionSelector: FC<T.PositionSelectorProps> = ({
    initial,
    initialWidth,
    type
}) => {
    const availablePositions = D.getPositions(type);

    const [chosenPosition, setChosenPosition] = useState(
        initial ?? availablePositions[0]
    );

    if (chosenPosition) {
        return (
            <div className="product-position-selector">
                <label
                    htmlFor="_wpc2o_chosen_position"
                    className="selector-label"
                >
                    <span className="selector-header">
                        Select the <strong>position</strong> of this logo
                    </span>
                    <select
                        name="_wpc2o_chosen_position"
                        id="_wpc2o_chosen_position"
                        className="select short selectProductType"
                        disabled={availablePositions.length <= 0}
                        onChange={(event: ChangeEvent<HTMLSelectElement>) => {
                            const selectedOption = document.querySelector(
                                `#${event.target.id}_${event.target.value}`
                            ) as HTMLElement | null;

                            if (selectedOption) {
                                setChosenPosition(
                                    selectedOption.dataset
                                        .position as T.LogoLocations
                                );
                            }
                        }}
                    >
                        {availablePositions.map((position) => (
                            <option
                                key={position}
                                id={`_wpc2o_chosen_position_${D.Data.clothing[type].positions[position]?.code}`}
                                value={`${D.Data.clothing[type].positions[position]?.code}`}
                                data-position={position}
                            >
                                {`${D.Data.clothing[type].positions[position]?.label}`}
                            </option>
                        ))}
                    </select>
                </label>

                <WidthSelector
                    key={chosenPosition}
                    initial={initialWidth}
                    type={type}
                    position={chosenPosition}
                />
            </div>
        );
    }

    return null;
};

const WidthSelector: FC<T.WidthSelectorProps> = ({
    initial,
    type,
    position
}) => {
    const widths = D.getWidths(type, position);
    const first = widths ? widths[0].toString() : null;

    const [selectedWidth, setSelectedWidth] = useState<string | null>(first);

    if (widths) {
        return (
            <>
                <div>
                    <label
                        htmlFor="_wpc2o_chosen_width"
                        className="selector-label"
                    >
                        <span className="selector-header">
                            Select the <strong>width(cm)</strong> of this logo
                        </span>
                        <select
                            name="_wpc2o_chosen_width"
                            id="_wpc2o_chosen_width"
                            className="select short"
                            defaultValue={initial}
                            onChange={(event: ChangeEvent<HTMLSelectElement>) =>
                                setSelectedWidth(event.target.value)
                            }
                        >
                            {widths.map((width) => (
                                <option
                                    key={type + '-' + position + '-' + width}
                                    value={width}
                                >
                                    {width}cm
                                </option>
                            ))}
                        </select>
                    </label>
                </div>
            </>
        );
    }

    return null;
};

export default ProductTypeSelector;
