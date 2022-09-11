/* eslint-disable @typescript-eslint/no-unused-vars */
import * as T from './types';

export const clothingTypes: T.ClothingType[] = [
    'top',
    'bag',
    'bottoms',
    'hat',
    'teaTowels',
    'tie'
];

export const getPositions = (type: T.ClothingType) => {
    return Object.entries(Data.clothing[type].positions).map(
        (item) => item[1].id
    );
};

export const getWidths = (type: T.ClothingType, position: T.LogoLocations) => {
    console.log({ type, position });

    return Data.clothing[type].positions[position]?.widths;
};

export const Data: T.Data = {
    clothing: {
        top: {
            positions: {
                rightSleeve: {
                    id: 'rightSleeve',
                    label: 'Right sleeve',
                    code: 1,
                    widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                },
                rightBottom: {
                    id: 'rightBottom',
                    label: 'Right bottom',
                    code: 2,
                    widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                },
                rightChest: {
                    id: 'rightChest',
                    label: 'Right chest',
                    code: 3,
                    widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                },
                centerChest: {
                    id: 'centerChest',
                    label: 'Center chest',
                    code: 4,
                    widths: [
                        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,
                        17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30
                    ]
                },
                centerBack: {
                    id: 'centerBack',
                    label: 'Center back',
                    code: 8,
                    widths: [
                        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,
                        17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30
                    ]
                },
                leftSleeve: {
                    id: 'leftSleeve',
                    label: 'Left sleeve',
                    code: 7,
                    widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                },
                leftChest: {
                    id: 'leftChest',
                    label: 'Left chest',
                    code: 5,
                    widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                },
                leftBottom: {
                    id: 'leftBottom',
                    label: 'Left bottom',
                    code: 6,
                    widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                },
                topBack: {
                    id: 'topBack',
                    label: 'Top back',
                    code: 9,
                    widths: [
                        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,
                        17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30
                    ]
                },
                bottomBack: {
                    id: 'bottomBack',
                    label: 'Bottom back',
                    code: 12,
                    widths: [
                        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,
                        17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30
                    ]
                },
                topChest: {
                    id: 'topChest',
                    label: 'Top chest',
                    code: 17,
                    widths: [
                        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,
                        17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30
                    ]
                },
                insideBack: {
                    id: 'insideBack',
                    label: 'Inside back (labels)',
                    code: 18,
                    widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                }
            }
        },
        bottoms: {
            positions: {
                leftPocket: {
                    id: 'leftPocket',
                    label: 'Left pocket',
                    code: 15,
                    widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                },
                rightPocket: {
                    id: 'rightPocket',
                    label: 'Right pocket',
                    code: 16,
                    widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                }
            }
        },
        bag: {
            positions: {
                front: {
                    id: 'front',
                    label: 'Front',
                    code: 13,
                    widths: [
                        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,
                        17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30
                    ]
                }
            }
        },
        hat: {
            positions: {
                front: {
                    id: 'front',
                    label: 'Front',
                    code: 11,
                    widths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                }
            }
        },
        teaTowels: {
            positions: {
                center: {
                    id: 'center',
                    label: 'Center',
                    code: 14,
                    widths: [
                        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,
                        17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30
                    ]
                }
            }
        },
        tie: {
            positions: {
                front: {
                    id: 'front',
                    label: 'Center',
                    code: 19,
                    widths: [1, 2, 3, 4, 5]
                }
            }
        }
    }
};
