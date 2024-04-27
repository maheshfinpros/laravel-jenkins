pipeline {
    agent any

    stages {
        stage('Checkout Repo') {
            steps {
                // Checkout the code from your GitHub repository using Git credentials
                git credentialsId: 'mahesh-github-cre', url: 'https://github.com/maheshfinpros/laravel-jenkins.git'
            }
        }

        stage('Zipping and Redirecting Project') {
            steps {
                script {
                    // Zip your entire repository files
                    sh 'zip -r project.zip .'
                    // Upload zip file to remote server's /var/www directory
                    withCredentials([sshUserPrivateKey(credentialsId: '2eb2b63e-f75c-4781-b8ce-e6da1181cba4', keyFileVariable: 'SSH_KEY')]) {
                        sh "scp -i \$SSH_KEY project.zip ubuntu@13.232.25.21:/var/www/"
                    }
                    // Extract zip file on the target server
                    sh 'ssh -i $SSH_KEY ubuntu@13.232.25.21 "cd /var/www/ && unzip -o project.zip"'
                }
            }
        }
    }

    post {
        always {
            // Clean up workspace after build
            cleanWs()
        }
    }
}
