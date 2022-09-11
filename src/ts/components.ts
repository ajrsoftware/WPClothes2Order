import React from 'react';
import { populate, register } from 'react-abode';

import ProductList from '../components/ProductList';
import ProductTypeSelector from '../components/ProductTypeSelector';

register('ProductList', () => React.memo(ProductList));
register('ProductTypeSelector', () => React.memo(ProductTypeSelector));

// Use it, accepts options
populate();
