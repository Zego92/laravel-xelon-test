import {FC} from 'react';

export const Events: FC<{ events: string[] }> = ({ events }): JSX.Element => {
    return(
        <ul>
            {
                events.map((event: any, index: number) =>
                    <li key={ index }>{ event }</li>
                )
            }
        </ul>
    );
};
