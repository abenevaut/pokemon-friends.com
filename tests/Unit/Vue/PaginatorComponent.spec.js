import { mount } from '@vue/test-utils';
// Define alias at webpack.mix.js.
import PaginatorComponent from '@/components/PaginatorComponent.vue';

const sinon = require('sinon');

// const WrappedPaginatorComponent = {
//   components: { PaginatorComponent },
//   template: `<div><PaginatorComponent v-bind="$attrs" v-on="$listeners" /></div>`
// };

describe('PaginatorComponent.vue', () => {

  it('show pagination for page 2 and go to previous page', async () => {
    const broadcast = sinon.stub();
    const wrapper = mount(PaginatorComponent, {
      propsData: {
        prev_page_url: '/endpoint?page=1',
        current_page: 2,
        next_page_url: '/endpoint?page=3',
      },
    });

    wrapper.setMethods({
      broadcast,
    });

    await wrapper.vm.$nextTick();

    expect(wrapper.find('button.sub').displayed()).toBeTruthy();
    expect(wrapper.find('button.add').displayed()).toBeTruthy();

    wrapper.find('button.sub').trigger('click');
    expect(wrapper.vm.$data.page).toEqual(1);
    expect(broadcast.calledOnce).toBeTruthy();
  });

  it('show pagination for page 2 and go to next page', async () => {
    const broadcast = sinon.stub();
    const wrapper = mount(PaginatorComponent, {
      propsData: {
        prev_page_url: '/endpoint?page=1',
        current_page: 2,
        next_page_url: '/endpoint?page=3',
      },
    });

    // wrapper.setMethods({
    //   broadcast,
    // });

    await wrapper.vm.$nextTick();

    expect(wrapper.find('button.sub').displayed()).toBeTruthy();
    expect(wrapper.find('button.add').displayed()).toBeTruthy();

    wrapper.find('button.add').trigger('click');
    expect(wrapper.vm.$data.page).toEqual(3);
    // expect(broadcast.calledOnce).toBeTruthy();
  });
});
