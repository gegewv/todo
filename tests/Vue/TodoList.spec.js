import { shallow, mount } from "vue-test-utils";
import expect from 'expect';
import TodoList from '../../resources/js/components/todo-list.vue';
import moxios from 'moxios';

describe('TodoList', () => {
    beforeEach(() => {
        moxios.install(axios);
    });

    afterEach(() => {
        moxios.uninstall(axios);
    });

    it('renders the correct title on the page', () => {
        let wrapper = shallow(TodoList);

        expect(wrapper.html()).toContain('Todo List');
    });

    it('show the todos fetched from the api', (done) => {
        let wrapper = mount(TodoList);

        moxios.stubRequest('/todos', {
            status: 200,
            response: [
                {
                    id: 1,
                    text: "Bingo",
                    finished: false,
                    created_at: "2019-01-01 00:00:00",
                    updated_at: "2019-01-01 00:00:00"
                }
            ],
        });

        moxios.wait(() => {
            expect(wrapper.html()).toContain('Bingo');
            done();
        })
    });
});
