## Laravel + Vuejs + Tailwind CSS 构建一个 Todo App

### 工具版本

- laravel v6.*
- tailwind v0.7.4

### 教程指南

- 原文
    - [How to Build a Vue.js Component With Tailwind in a Laravel Project](https://nick-basile.com/blog/post/how-to-build-a-vuejs-component-with-tailwind-in-a-laravel-project)
    - [Building a Todo App With Laravel, Vue.js, and Tailwind CSS Part II](https://nick-basile.com/blog/post/building-a-todo-app-with-laravel-vuejs-and-tailwind-css-part-ii)
    - [Building a Todo App With Laravel, Vue.js, and Tailwind CSS Part III](https://nick-basile.com/blog/post/building-a-todo-app-with-laravel-vuejs-and-tailwind-css-part-iii)
    - [Testing a Vue.js and Laravel Todo App](https://nick-basile.com/blog/post/testing-a-vuejs-and-laravel-todo-app)

- Learnku 译文
    - [Laravel + Vuejs + Tailwind CSS 构建一个 Todo App 第一部分](https://learnku.com/laravel/t/36641)
    - [Laravel + Vuejs + Tailwind CSS 构建一个 Todo App 第二部分](https://learnku.com/laravel/t/36748)
    - [Laravel + Vuejs + Tailwind CSS 构建一个 Todo App 第三部分](https://learnku.com/laravel/t/37062)
    - [Laravel + Vuejs + Tailwind CSS 构建一个 Todo App 第四部分](https://learnku.com/laravel/t/37136)


### ERROR（以下是我遇到的问题和我的解决方法，如有更好的解决方法请麻烦告诉我一下）

- 如何引入 `tailwind` :
    - 参考资料：
        - [如何在Laravel中使用Tailwind CSS?](https://learnku.com/laravel/t/36453)
        - [Setting Up Tailwind In A Laravel Project](https://nick-basile.com/blog/post/setting-up-tailwind-in-a-laravel-project)
        - [查看 TaiilWind 官方文档](https://v0.tailwindcss.com/docs/installation/)
        
    - 本人的配置：
        - 安装：
            ```
            # 使用 npm
            npm install tailwindcss --save-dev
            # 使用 Yarn
            yarn add tailwindcss --dev
            ```
        - 生成配置文件
            ```
            ./node_modules/.bin/tailwind init tailwind.js
            ```
        - 配置
            ```scss
            // /resource/sass/app.scss
            @tailwind preflight;
            @tailwind components;
            @tailwind utilities;
            ```
          
            ```javascript
            // /webpack.min.js
            const mix = require('laravel-mix');
            let tailwindcss = require('tailwindcss');
            
            mix.js('resources/js/app.js', 'public/js')
               .sass('resources/sass/app.scss', 'public/css')
                .options({
                    processCssUrls: false,
                    postCss: [ tailwindcss('./tailwind.js') ],
                });
            ```

- 使用Vue Test Utils 库来测试时，运行 `npm run test-js` 时出现一下错误信息：
```shell script
    Error: Chunk.parents: Use ChunkGroup.getParents() instead
```
解决方法：(更换 `mocha-webpack` 的版本)
```
    "mocha": "^5.2.0",
    "mocha-webpack": "^2.0.0-beta.0"
```





