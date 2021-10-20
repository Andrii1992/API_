import { extend } from 'vee-validate';
import * as rules from 'vee-validate/dist/rules';
import Vue from 'vue'
import {ValidationObserver,ValidationProvider} from 'vee-validate'


Object.keys(rules).forEach(rule => {
  extend(rule, rules[rule]);
});

// with typescript
for (let [rule, validation] of Object.entries(rules)) {
  extend(rule, {
    ...validation
  });
}

Vue.component('ValidationObserver',ValidationObserver)
Vue.component('ValidationProvider', ValidationProvider)