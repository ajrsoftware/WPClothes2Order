import React from 'react';
import { populate, register } from 'react-abode';

import ProductList from '../components/ProductList';

register('ProductList', () => React.memo(ProductList));

// Use it, accepts options
populate();
