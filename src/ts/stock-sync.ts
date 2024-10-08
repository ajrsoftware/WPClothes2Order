type Response = {
    status: boolean;
    message: string;
};

export const sync = async (): Promise<Response | null> => {
    let res: Response | null = null;

    try {
        const response = await fetch(`/wp-json/wpc2o/v1/stock-sync/`, {
            method: 'get',
            headers: {
                'Content-Type': 'application/json'
            }
        });
        res = await response.json();

        console.log(res);

        if (response.ok) {
            res = await response.json();
        }
    } catch (err) {
        console.log({ err });
        res = {
            status: false,
            message: 'There was a problem requesting a stock sync.'
        };
    }

    return res;
};
