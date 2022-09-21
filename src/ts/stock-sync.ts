import axios from 'axios';

type Response = {
    status: boolean;
    message: string;
};

export const sync = async (): Promise<Response | null> => {
    let res: Response | null = null;

    try {
        const response = await axios.get<Response>(
            `/wp-json/wpc2o/v1/stock-sync`
        );

        if (response.status === 200) res = response.data;
    } catch (err) {
        res = {
            status: false,
            message: 'There was a problem requesting a stock sync.'
        };
    }

    return res;
};
