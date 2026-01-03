
# DATE=$(date '+%Y-%m-%d_%H-%M-%S')
# PROJECT_DIR="/home/shady-mohamed/rak-charity/projects/supports"
# LOG_FILE="$PROJECT_DIR/backup_log.txt"


# exec > >(tee -a "$LOG_FILE") 2>&1

# echo "======== Backup started at $DATE ========"


# echo "Dumping database..."
# mysqldump rakcharity > "$PROJECT_DIR/rakcharity_db.sql"


# git config user.name "shadymohamedamin"
# git config user.email "shadimabdrawy1999@gmail.com"


# cd "$PROJECT_DIR" || exit


# git checkout shady

# echo "Adding changes to git..."
# git add .


# if ! git diff --cached --quiet; then
#   echo "Changes detected. Committing and pushing..."
#   git commit -m "Auto backup: $DATE"
#   git push origin -u shady
# else
#   echo "No changes to commit."
# fi

# echo "======== Backup ended at $(date '+%Y-%m-%d_%H-%M-%S') ========"
# echo ""





#!/bin/bash

# Paths
# LOG_FILE="/home/shady-mohamed/rak-charity/projects/supports/backup_log.txt"
# DB_PATH="/home/shady-mohamed/rak-charity/projects/supports/rakcharity_db.sql"
# DATE=$(date +%F_%H-%M-%S)

# echo -e "\n======== Backup started at $DATE ========" >> "$LOG_FILE"

# {
#   echo "Dumping database..."
#   mysqldump rakcharity > "$DB_PATH" 2>&1

#   echo "Git operations..."
#   cd /home/shady-mohamed/rak-charity/projects/supports/ || exit 1
#   git config user.name "shadymohamedamin"
#   git config user.email "shadimabdrawy1999@gmail.com"

#   git checkout shady
#   git add . -- ':!rakcharity_db.sql'

#   echo "Committing changes if any..."
#   if ! git diff --cached --quiet; then
#     git commit -m "Auto backup: $DATE"
#     git push origin shady
#     echo "Changes committed and pushed."
#   else
#     echo "No changes to commit."
#   fi

#   echo "======== Backup ended at $DATE ========"
# } >> "$LOG_FILE" 2>&1


# SUBJECT="📦 Backup Report for $DATE"
# TO="shadimabdrawy1999@gmail.com"

# {
#   echo "Subject: $SUBJECT"
#   echo "To: $TO"
#   echo
#   cat "$LOG_FILE"
# } | msmtp "$TO"
#!/bin/bash

#!/bin/bash

LOG_FILE="/home/shady/rak-charity/projects/supports/backup_log.txt"
TMP_LOG="/tmp/backup_current.log"
DB_PATH="/home/shady/rak-charity/projects/supports/rakcharity_db.sql"
DATE=$(date +%F_%H-%M-%S)
GZ_DB_PATH="$DB_PATH.gz"
STATUS="✅ Backup completed successfully"
ERROR_FOUND=false

# Start fresh temporary log for current run
echo -e "\n======== Backup started at $DATE ========" > "$TMP_LOG"

{
  echo "Dumping database..."
  if ! mysqldump rakcharity > "$DB_PATH" 2>>"$TMP_LOG"; then
    echo "❌ Error: Database dump failed." >> "$TMP_LOG"
    ERROR_FOUND=true
  fi

  echo "Compressing SQL file..."
  if ! gzip -f "$DB_PATH" 2>>"$TMP_LOG"; then
    echo "❌ Error: Compression failed." >> "$TMP_LOG"
    ERROR_FOUND=true
  fi

  echo "Git operations..."
  cd /home/shady/rak-charity/projects/supports/ || exit 1
  git config user.name "shadymohamedamin"
  git config user.email "shadimabdrawy1999@gmail.com"

  git checkout shady

  # Avoid adding SQL or its gz to git
   #backup_supports.sh backup_log.txt
  git add "$COMPRESSED_DB"
  git add . -- ':!rakcharity_db.sql'
  git add . 

  echo "Committing changes if any..."
  if ! git diff --cached --quiet; then
    git commit -m "Auto backup: $DATE"
    git push origin shady
    echo "Changes committed and pushed."
  else
    echo "No changes to commit."
  fi

  echo "======== Backup ended at $DATE ========"
} >> "$TMP_LOG" 2>&1

# Append current log to full log history
cat "$TMP_LOG" >> "$LOG_FILE"

# Check for any failure
if grep -q "❌ Error" "$TMP_LOG"; then
  STATUS="❌ Backup completed with errors"
fi

# Prepare and send email with only the current backup log
SUBJECT="📦 Backup Report [$STATUS] - $DATE"
TO="shadimabdrawy1999@gmail.com"

{
  echo "Subject: $SUBJECT"
  echo "To: $TO"
  echo
  echo "$STATUS"
  echo
  cat "$TMP_LOG"
} | msmtp "$TO"

