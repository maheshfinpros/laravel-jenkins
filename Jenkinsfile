pipeline {
    agent any

    stages {
        stage('Checkout Repo') {
            steps {
                // Checkout the code from your GitHub repository
                git 'https://github.com/maheshfinpros/laravel-jenkins.git'
            }
        }

        stage('Zipping project') {
            steps {
                // Zip your entire repository files
                sh 'zip -r project.zip .'
            }
        }

        stage('Upload Artifact to Target Server') {
            steps {
                // Upload zip file to remote server's /var/www directory
                sh 'scp -i /var/lib/jenkins/.ssh/jenkins_rsa project.zip ubuntu@13.232.25.21:/var/www/'
            }
        }

        stage('Extracting Project') {
            steps {
                // Extract zip file on the target server
                sh 'ssh -i /var/lib/jenkins/.ssh/jenkins_rsa ubuntu@13.232.25.21 "cd /var/www/ && unzip -o project.zip"'
            }
        }
    }
}
