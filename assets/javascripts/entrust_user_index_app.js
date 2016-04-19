/**
 *= require entrust_app
 */
app.controller('userController', function($scope, $http, $mdDialog, $mdMedia, $mdToast) {

    $scope.customFullscreen = $mdMedia('xs') || $mdMedia('sm');

    $scope.showConfirm = function(ev, user, csrf) {
        // Appending dialog to document.body to cover sidenav in docs app
        var confirm = $mdDialog.confirm()
            .title('Update User')
            .textContent('Are you sure you want to enable/disable the user?')
            .ariaLabel('deactivate user')
            .targetEvent(ev)
            .ok('Confirm')
            .cancel('Cancel');

        $mdDialog.show(confirm).then(function() {
            $scope._updateUser(user,csrf);
        }, function() {
            console.log('Update User - Cancel');
        });
    };

    $scope._updateUser = function(user, csrf) {
        var token = {};
        token[csrf.name] = csrf.hash;
        token['id'] = user.id;

        var element = document.getElementById('user-' + user.id + '-state');
        var text = element.innerText || element.textContent;

        token['deleted'] = (text != 'disabled');

        $http({
            method: 'POST',
            url: 'http://' + document.location.host + '/index.php/entrust/api/cerberus/user/enable',
            data: token
        })
        .then(function(data) {
            element.innerHTML = (token['deleted']) ? 'disabled' : 'active';

            $mdToast.show(
                $mdToast.simple()
                .textContent('Updated')
                .action('UNDO')
                .highlightAction(true)
                .position('bottom right')
                .hideDelay(3000)
            ).then(function(response) {
                if (response == 'ok') {
                    $scope._updateUser(user, csrf);
                }
            });
        }, function(data) {
                console.log('error', data);
        });
    };
});