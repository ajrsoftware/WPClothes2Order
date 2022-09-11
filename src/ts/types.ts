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

export type WidthSelectorProps = {
    initial: number | undefined;
    type: ClothingType;
    position: LogoLocations;
};

export type PositionSelectorProps = {
    initial: LogoLocations | undefined;
    initialWidth: number | undefined;
    type: ClothingType;
};

export type ProductTypeSelectorProps = {
    type: ClothingType | undefined;
    position: LogoLocations | undefined;
    width: string | undefined;
};
