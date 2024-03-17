import React, {FC} from 'react';

export const ConnectionState: FC<{isConnected: boolean}> = ({ isConnected }): JSX.Element => {
    return <p>State: { '' + isConnected }</p>;
};
