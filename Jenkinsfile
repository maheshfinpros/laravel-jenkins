
pipeline {
    agent any

    environment {
        SSH_CREDENTIALS = credentials('3ee699db-7305-49a5-98ea-bad2b9b8ac15')
        REMOTE_SERVER = 'ubuntu@3.110.147.246'
        REMOTE_PATH = '/var/www'
    }

    stages {
        stage('Checkout REPO') {
            steps {
                git credentialsId: 'mahesh-github-cre', url: 'https://github.com/maheshfinpros/laravel-jenkins.git'
            }
        }

        stage('Build APP') {
            steps {
                sh 'composer install'
                sh 'php artisan key:generate'
                sh 'php artisan migrate'
                sh 'npm install'
                sh 'npm run prod'
            }
        }

        stage('Zipping project') {
            steps {
                sh 'zip -r project.zip .'
            }
        }

        stage('Upload Artifact to Target Server') {
            steps {
                sshPut(
                    credentialsId: "${SSH_CREDENTIALS}",
                    remoteFile: "${REMOTE_PATH}/project.zip",
                    localFile: 'project.zip'
                )
            }
        }

        stage('Extracting Project') {
            steps {
                sshCommand(
                    credentialsId: "${SSH_CREDENTIALS}",
                    remote: "${REMOTE_SERVER}",
                    command: "unzip ${REMOTE_PATH}/project.zip -d ${REMOTE_PATH}/project"
                )
            }
        }
    }
}
