const { src, dest } = require('gulp');

const foundationDir = 'node_modules/foundation-sites/dist/*/*.*';

function defaultTask(cb) {
    return src(foundationDir)
        .pipe(dest('public/assets/'));
}

exports.default = defaultTask