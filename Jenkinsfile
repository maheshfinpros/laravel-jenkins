pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                git 'https://github.com/maheshfinpros/laravel-jenkins.git'
            }
        }

        stage('Composer Install') {
            steps {
                dir('laravel-jenkins') {
                    sh 'composer install'
                }
            }
        }
    }
}
