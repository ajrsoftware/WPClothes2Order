export type ClothingType =
    | 'top'
    | 'bottoms'
    | 'bag'
    | 'hat'
    | 'teaTowels'
    | 'tie';
export type LogoLocations =
    | 'rightSleeve'
    | 'rightBottom'
    | 'rightChest'
    | 'centerChest'
    | 'centerBack'
    | 'leftSleeve'
    | 'leftChest'
    | 'leftBottom'
    | 'topBack'
    | 'bottomBack'
    | 'topChest'
    | 'insideBack'
    | 'leftPocket'
    | 'rightPocket'
    | 'front'
    | 'center';

export interface ClothingPositions {
    positions: {
        [key in LogoLocations]?: Position;
    };
}

export interface Position {
    id: LogoLocations;
    label: string;
    code: number;
    widths: number[];
}

export interface Data {
    clothing: {
        [key in ClothingType]: ClothingPositions;
    };
}

export type AddLogoProps = {
    type: ClothingType;
    position: LogoLocations;
    width: number;
};

export type WidthSelectorProps = {
    type: ClothingType;
    position: LogoLocations;
};

export type PositionSelectorProps = {
    type: ClothingType;
};

export type ProductTypeSelectorProps = {
    types: ClothingType[];
};
