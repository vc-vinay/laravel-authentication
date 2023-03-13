## GIT Standards for development team.

MUST Mandatory for Engineers who are part of this project.

Parent Branch - **main**

    Purpose - Production branch
    Server - Uploaded on production server. 

Development Branch - **development**

    Purpose - For development purpose and testing.
    Server - Uploaded on development server.

Developer/Engineers Branch - Eg - **feature/user**

    Create a feature specific branch from development branch​.
    Update your feature branch with a remote parent branch.​ 
    Branch name should not contain any special character except "-","_". Maintain the branch name throughout the project.​
    Feature branch name coule be - "feature/user", "feature/subscription".​

For QUICK fixing on production server or in master/main branch

    Do not touch the master/main branch directly on production. For any changes in master, please create a specific change-related branch or create "hotfix-date"​
    Example:- It could be hotfix-* or like hotfix-29-08-2020​
    Manage By Team Lead or Sr. Engineer

Stash

    Don't forgot to Stash your uncommitted changes if you want to test or check any other branch in your local system without merge/pull.​

Stale / Completed / Unnecessary  Branch

    Remove stale branches or temp branches once work is done.​ (Duration after 10 days of completed work)
