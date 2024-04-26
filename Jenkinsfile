pipeline {
    agent any
    
    stages {
        stage('Install Apache') {
            steps {
                script {
                    // SSH into the web server and install Apache
                    sshagent(['3ee699db-7305-49a5-98ea-bad2b9b8ac15']) {
                        sh '''
                            ssh ubuntu@3.110.147.246 'sudo apt-get update'
                            ssh ubuntu@3.110.147.246 'sudo apt-get install -y apache2'
                        '''
                    }
                }
            }
        }
    }
}
