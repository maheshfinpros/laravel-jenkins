pipeline {
    agent any
    
    stages {
        stage('Install Apache') {
            steps {
                script {
                    sshScript remote: [
                        host: '3.110.147.246', // Your server's IP address
                        user: 'ubuntu', // SSH username
                        port: 22, // SSH port (default is 22)
                        credentialsId: '3ee699db-7305-49a5-98ea-bad2b9b8ac15' // ID of the SSH credentials configured in Jenkins
                    ], script: '''
                        sudo apt update
                        sudo apt install -y apache2
                    '''
                }
            }
        }
    }
}
