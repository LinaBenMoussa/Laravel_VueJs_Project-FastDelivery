import { createStore } from 'vuex'
import Foodstore from './modules/foodFeature'
import createPersistedState from 'vuex-persistedstate';

export default createStore({
    modules: {
      Foodstore
    },
    plugins: [createPersistedState()],
})
